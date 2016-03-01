<?php

//namespace Elms\EFlashMessage;
namespace Enax\EFlashMessage;


/**
 * Elms\EFlashMessage\EFlashMessage
 *
 * Denna klass skapar en funktion för flash meddelande.
 */

class EFlashMessage {

	
	
	/**
	 * Initalerar kontrollen
	 * 
	 * @return void
	 */
    public function __construct() {
        if (!isset($_SESSION['msg'])) {
            $_SSESSION['msg'] = array();
        }
    }

	/**
	 * Lägg till medelande till session arrayen
	 *
	 * @param $type string med meddelandes typ
	 * @param $content string med meddelandet
	 *
	 * @return void
	 */
	public function setMsg($type, $content) {
		
		$message = array('type' => $type, 'content' => $content);
		$_SESSION['msg'][], $message;
	}

	/**
	 * Lägg till ett alert meddelande
	 *
	 * @param $message string med meddelandets test
	 *
	 * @return void
	 */
	public function alert($message) {
		$alert = array('alert', 'content' => $message);
		$_SESSION['msg'][] = $alert;
	}
	
		
	/**
	 * Lägg till ett sucess meddelande
	 *
	 * @param $message string med meddelandets test
	 *
	 * @return void
	 */
	public function success($message) {
		$success = array('success', 'content' => $message);
		$_SESSION['msg'][] = $success;
	}
		
	
	/**
	 * Lägg till ett error meddelande
	 *
	 * @param $message string med meddelandets test
	 *
	 * @return void
	 */
	public function error($message) {
		$error = array('error', 'content' => $message);
		$_SESSION['msg'][] = $error;	}
		
	
	/**
	 * Lägg till ett informations meddelande
	 *
	 * @param $message string med meddelandets test
	 *
	 * @return void
	 */
	public function info($message) {
		$info = array('info', 'content' => $message);
		$_SESSION['msg'][] = $info;
	}

	
	/**
	 * Prints the messages in the session flasher
	 */
	public function outputMsgs() {
		$messages = $_SESSION['msg'];
		$output = null;

		if(isset($messages)) {
			foreach($messages as $key => $message) {
				$output .= '<div class="' . $message['type'] . '"><p>' . $message['content'] . '</p></div>';
			}
		}

			return $output;
		}

	/**
	 * Clear messages in the session messenger
	 */
	public function clearMsg() {
		$_SESSION['msg'] = null;
	}
}