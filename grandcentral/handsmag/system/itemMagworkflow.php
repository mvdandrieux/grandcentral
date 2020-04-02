<?php
use \Mailjet\Resources;
/**
 * Projects
 *
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemMagworkflow extends _items
{
	protected $mailjet_key = 'aa0b1411e8782a230eacf814cb7ffca7';
	protected $mailjet_secret = '152427259a82cb0c5f3268acb67f8520';

/**
 * Execute the workflow
 *
 * @access  public
 */
	public function get_status()
	{
		return $this['itemstatus']->get();
	}
/**
 * Execute the workflow
 *
 * @access  public
 */
	public function process(itemMagazine $magazine)
	{
		// envois des mails
		if (!$this['mailtosend']->is_empty())
		{
			foreach ($this['mailtosend']->unfold() as $mail)
			{
				$this->sendmail($mail, $magazine);
			}
		}

	}
/**
 * Send a mail via Mandrill
 *
 * @access  public
 */
	public function sendmail(itemMandrillmail $mail, itemMagazine $magazine)
	{
		if (!$mail['to']->is_empty())
		{
			$mailjet = new \Mailjet\Client($this->mailjet_key, $this->mailjet_secret);

			$mail->replace_text_with_data(array('link' => $magazine->get_source()));

			$text = str_replace('&apos;','\'',htmlspecialchars_decode($mail['content']->get(), ENT_QUOTES));
			// create message data
			$body = [
        'FromEmail' => $mail['fromemail']->get(),
        'FromName' => $mail['fromname']->get(),
        'Subject' => $mail['subject']->get(),
        'Html-part' => nl2br($text),
				'TextPart' => $text,
        'Recipients' => []
      ];
			// destinataires
			foreach ($mail['to']->unfold() as $to)
			{
				$body['Recipients'][] = array(
					'Email' => $to['email']->get(),
					'Name' => $to['title']->get(),
				);
			}
			$response = $mailjet->post(Resources::$Email, ['body' => $body]);
			// echo "<pre>";print_r($response);echo "</pre>";

			if ($response->success())
			{
				$return = array(
					'success' => true
				);
			}
			else
			{
				$return = array(
					'success' => false
				);
			}
		}
	}
}
?>
