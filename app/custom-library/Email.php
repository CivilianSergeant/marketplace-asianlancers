<?php

class Email{
	
	public static function SendNotification($option,$data)
	{
		$emailTemplate = $option;

		/*switch($option)
		{
			case 'JobPostAdmin':
				$emailTemplate = 'emails.notification.job-post-admin';
				break;

			case 'JobPostClient':

				$emailTemplate = 'emails.notification.job-post-client';
				break;

			case 'JobOffer':
				$emailTemplate = 'emails.notification.job-offer';
				break;

			case 'JobPhase':
				$emailTemplate = 'emails.notification.job-phase';
				break;
		}*/

		if(!empty($emailTemplate))
		{
			Mail::queue($emailTemplate, $data, function ($message) use($data){
	                $message->to($data['email'], $data['name'])->subject($data['subject']);
	        });
		}else{
			return false;
		}
	}

}