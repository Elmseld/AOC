<?php

namespace Enax\Tags;

/**
 * A controller for users and admin related events.
 *
 */
class TagsController implements \Anax\DI\IInjectionAware {

    use \Anax\DI\TInjectable;

    private $customhits = array(4, 8, 16);

    /**
    * Initialize the controller.
    *
    * @return void
    */
    public function initialize() {
        $this->tag = new \Enax\Tags\Tags();
        $this->tag->setDI($this->di);
    }

    /**
    * List all
    *
    * @param int $hits, number of hits per page
    * @param int $page, page for offset
    *
    * @return void
    */
    public function listAction($hits = 8, $page = 0) {

        $thits = $this->di->request->getGet('hits') ? $this->di->request->getGet('hits') : $this->di->session->get('thits');
        $thits = $thits != null ? $thits : 8;
        $this->di->session->set('thits', $thits);
        $page = $this->di->request->getGet('page') ? $this->di->request->getGet('page') : 0;

        $all = null;

        $all = $this->tag->query()
        ->limit($thits)
        ->offset($page)
        ->where('deleted IS NULL')
        ->groupBy('id')
        ->orderBy('name ASC')
        ->execute();;

        foreach ($all as $tag) {
            $this->db->select("COUNT(idQuestion) AS taggedquestions")
            ->from('tag2question')
            ->where('idTag = '.$tag->getProperties()['id'])
            ->execute();
            $res = $this->db->fetchAll();
            $tag->setProperties(['taggedquestions' => $res[0]->taggedquestions]);
        }

        $count = $this->tag->query("COUNT(*) AS count")
        ->where('deleted IS NULL')
        ->execute();

        $get = array('hits' => $thits, 'page' => $page);
        $pagelinks = $this->pager->paginateGet($count[0]->count, 'tag/index', $get, $this->customhits);

        $this->theme->setTitle('Taggar');
        $this->views->add('tags/list-all', [
            'tags' => $all,
            'pages' => $pagelinks,
            'title' => 'Taggar',
        ]);
    }

    /**
    * Find with id.
    *
    * @param int $id
    *
    * @return void
    */
    public function idAction($id = null) {

        $res = $this->tag->find($id);

        if ($res) {
            $this->theme->setTitle('Tag');
            $this->views->add('tag/view', [
                'content' => [$res],
                'title' => 'Tag Detail view',
            ], 'main');
        } else {
            $url = $this->url->create('tag');
            $this->response->redirect($url);
        }
    }

    /**
    * Find most popular
    *
    * @param int $limit, no of post to fetch
    *
    * @return array $populartags, order by most popular
    */
    public function getMostPopularAction($limit, $title) {
        $populartags = null;

        $populartags = $this->tag->query("t.*, COUNT(t2q.idQuestion) AS taggedquestions")
        ->from('tags AS t')
        ->join('tag2question AS t2q', 't.id = t2q.idTag')
        ->where('t.deleted IS NULL')
        ->groupBy('t.id')
        ->orderBy('taggedquestions DESC')
        ->limit($limit)
        ->execute();

        $this->views->add('tags/list-side', [
            'title' => $title,
            'tags' => $populartags,
        ]);
    }

    /**
    * Add new tag form
    *
    * @return void
    */
    public function addAction() {

        if ($this->di->LoginController->checkLoginAdmin($this->di->session->get('id'))) {

            $this->tag = $this->di->session->get('temptag');

            $form = new \Enax\HTMLForm\EFormAddTag($this->tag);
            $form->setDI($this->di);
            $form->check();

            $this->di->theme->setTitle('Nytt ämne');
            $this->views->add('tag/add', [
                'title' => 'Nytt ämne',
                'content' => $this->di->msgFlash->outputMsgs() . $form->getHTML()
            ]);
            $this->di->msgFlash->clearMessages();
        } else {
            $url = $this->url->create('tag');
            $this->response->redirect($url);
        }

    }
}