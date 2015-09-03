<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemMail extends _items
{
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  admin ou site (environnement courant par défaut)
 * @access	public
 */
	public function __construct($env = env)
	{
		$env = 'site';
		parent::__construct($env);
	}
	
	public function replace_text_with_data($datas)
	{
		$msg = (string) $this['content'];
		preg_match_all("/\[([a-zA-Z0-9=&]+)\]/", $msg, $results, PREG_SET_ORDER);
		foreach ((array) $results as $result)
		{
			if (isset($datas[$result[1]]))
			{
				$msg = str_replace($result[0], $datas[$result[1]], $msg);
			}
		}
		//print'<pre>';print_r($msg);print'</pre>';
		$this['content'] = $msg;
	}
	
	public function sendtohuman(itemHuman $human, array $datas = null)
	{
		if ($this->exists())
		{
		//Create a new PHPMailer instance
			$mail = new PHPMailer();
			$mail->CharSet = 'UTF-8';
			$mail->isSendmail();
		//Set who the message is to be sent from
			$mail->setFrom($this['from'], $this['fromname']);
		//Set an alternative reply-to address
			$mail->addReplyTo($this['reply'], $this['replyname']);
		//Set who the message is to be sent to
			// $mail->addAddress($user['key'], $user['title']);
			$mail->addAddress($human['key'], $human['title']);
		//Set the subject line
			$mail->Subject = $this['subject'];
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
			// $mail->msgHTML('<p>Login : '.$user['key'].'</p><p>Password : '.$password.'</p>');
			$txt = nl2br($this->replace_text_with_data($datas));
			
			$mail->msgHTML($txt);
		//Replace the plain text body with one created manually
			// $mail->AltBody = '
			// Login : '.$user['key'].'
			// Password : '.$password.'
			// ';
		//Attach an image file
			// $mail->addAttachment('images/phpmailer_mini.gif');

			//send the message, check for errors
			if (!$mail->send())
			{
			    $validation = "Mailer Error: " . $mail->ErrorInfo;
			} else {
			    $validation =  "Message sent!";
			}
		}
		else
		{
			return false;
		}
	}
	
	public function send()
	{
		if ($this->exists())
		{
		//Create a new PHPMailer instance
			$mail = new PHPMailer();
			$mail->CharSet = 'UTF-8';
			$mail->isSendmail();
		//Set who the message is to be sent from
			$mail->setFrom($this['fromemail'], $this['fromname']);
		//Set an alternative reply-to address
			$mail->addReplyTo($this['fromemail'], $this['fromname']);
		//Set who the message is to be sent to
			// $mail->addAddress($user['key'], $user['title']);
			$mail->addAddress($this['toemail'], $this['toname']);
		//Set the subject line
			$mail->Subject = htmlspecialchars_decode($this['subject'], ENT_HTML5);
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
			// $mail->msgHTML('<p>Login : '.$user['key'].'</p><p>Password : '.$password.'</p>');
			$txt = nl2br(htmlspecialchars_decode((string) $this['content'], ENT_HTML5));
			
			$mail->msgHTML($txt);
		//Replace the plain text body with one created manually
			// $mail->AltBody = '
			// Login : '.$user['key'].'
			// Password : '.$password.'
			// ';
		//Attach an image file
			// $mail->addAttachment('images/phpmailer_mini.gif');
			
			//send the message, check for errors
			if (!$mail->send())
			{
			    $validation = "Mailer Error: " . $mail->ErrorInfo;
			} else {
			    $validation =  "Message sent!";
			}
		}
		else
		{
			return false;
		}
	}
}
?>