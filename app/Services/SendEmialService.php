<?php

namespace App\Services;

use SendGrid\Mail\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\EmailLogs;

class SendGridService
{
    // public function sendSendGridEmail($subject, $bladeViewName, $viewData, $from, $to)
    // {
    //     try {
    //         // Render Blade view as HTML
    //         $htmlContent = view($bladeViewName, $viewData)->render();

    //         $email = new Mail();
    //         $email->setFrom($from['email'], $from['name']);
    //         foreach ($to as $recipient) {
    //             $email->addTo($recipient['email'], $recipient['name']);
    //         }
    //         $email->setSubject($subject);
    //         $email->addContent("text/html", $htmlContent);

    //         $sendgrid = new SendGrid(env('SENDGRID_API_KEY'));
    //         $response = $sendgrid->send($email);

    //         Log::info('SendGrid Response: ' . $response->statusCode());

    //         return $response->statusCode() == 202 ? "Email sent successfully" : "Failed to send email";
    //     } catch (\Exception $e) {
    //         Log::error('SendGrid Error: ' . $e->getMessage());
    //         return "Error sending email: " . $e->getMessage();
    //     }
    // }
    // Your email log model

    public function sendSendGridEmail($to, $subject, $bladeViewName, $viewData)
    {
        // Create email log
        $EmailLog = new EmailLogs();
        $EmailLog->app = 'Fama Real Estate';

        // Render Blade template as HTML
        $htmlContent = view($bladeViewName, $viewData)->render();

        // Log request data
        $req = [
            "sender" => ["name" => "Test", "email" => "test@email.com"],
            "to" => $to,
            "subject" => $subject
        ];
        $EmailLog->requested = json_encode($req);

        try {
            // Prepare SendGrid email
            $email = new Mail();
            $email->setFrom("test@email.com", "Test");
            foreach ($to as $recipient) {
                $email->addTo($recipient['email'], $recipient['name']);
            }
            $email->setSubject($subject);
            $email->addContent("text/html", $htmlContent);

            // Send email
            $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
            $response = $sendgrid->send($email);

            // Log response
            $EmailLog->response = json_encode([
                "status_code" => $response->statusCode(),
                "headers" => $response->headers(),
                "body" => (string) $response->body()
            ]);
            $EmailLog->save();

            return $response->statusCode() == 202 ? "true" : "Failed to send email";
        } catch (\Exception $e) {
            $EmailLog->response = json_encode(["error" => $e->getMessage()]);
            $EmailLog->save();

            return "Something Went Wrong. Please Try Again later: " . $e->getMessage();
        }
    }
}
