<?php

namespace Enax\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentsInSession implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;



    /**
     * Add a new comment.
     *
     * @param array $comment with all details.
     * 
     * @return void
     */
    public function add($comment, $pageKey)
    {
        $comments = $this->session->get('comments', []);
        $comments[$pageKey][] = $comment;
        $this->session->set('comments', $comments);
    }



    /**
     * Find and return all comments.
     *
     * @return array with all comments.
     */
    public function findAll($pageKey = null)
    {
        $comments = $this->session->get('comments', []);
        if(!array_key_exists($pageKey, $comments)){
            return '';
        }
        return $comments[$pageKey];
    }

    public function findComment($pageKey, $id){
        $comments = $this->session->get('comments', []);
        return $comments[$pageKey][$id];
    }

    public function deleteComment($id, $pageKey){
        $comments = $this->session->get('comments', []);
        unset($comments[$pageKey][$id]);
        $this->session->set('comments', $comments);
    }

    /**
     * Edit a comment.
     *
     */
    public function editComment($comment, $pageKey, $id)
    {
        $comments = $this->session->get('comments', []);
        $comments[$pageKey][$id] = $comment;
        $this->session->set('comments', $comments);
    }


    /**
     * Delete all comments.
     *
     */
    public function deleteAll()
    {
        $this->session->set('comments', []);
    }
}
