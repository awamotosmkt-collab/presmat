<?php

namespace Pandao\Common\Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailUtils
{
    /**
     * Retrieves a mail template from the database and replaces placeholders.
     *
     * @param Database $db Database connection.
     * @param string $type The mail type/code.
     * @param array $vars Placeholder => value pairs.
     * @return array|false Array with 'subject' and 'content', or false if not found.
     */
    public static function getMail($db, $type, $vars = [])
    {
        $stmt = $db->prepare('SELECT * FROM pm_mail WHERE type = :type AND lang = :lang LIMIT 1');
        $stmt->execute(['type' => $type, 'lang' => PMS_LANG_ID]);
        $mail = $stmt->fetch();

        if (!$mail) return false;

        $content = $mail['content'];
        $subject = $mail['subject'];

        foreach ($vars as $placeholder => $value) {
            $content = str_replace($placeholder, $value, $content);
            $subject = str_replace($placeholder, $value, $subject);
        }

        return ['subject' => $subject, 'content' => $content];
    }

    /**
     * Sends an email using PHPMailer.
     *
     * @param string $to Recipient email.
     * @param string $toName Recipient name.
     * @param string $subject Email subject.
     * @param string $body HTML body.
     * @param string $replyTo Reply-to email.
     * @param string $replyToName Reply-to name.
     * @return bool True on success, false on failure.
     */
    public static function sendMail($to, $toName, $subject, $body, $replyTo = '', $replyToName = '')
    {
        $mail = new PHPMailer(true);

        try {
            $mail->CharSet = 'UTF-8';
            $mail->setFrom(PMS_SENDER_EMAIL, PMS_SENDER_NAME);
            $mail->addAddress($to, $toName);

            if (!empty($replyTo)) {
                $mail->addReplyTo($replyTo, $replyToName);
            }

            if (PMS_USE_SMTP == 1) {
                $mail->isSMTP();
                $mail->Host = PMS_SMTP_HOST;
                $mail->Port = PMS_SMTP_PORT;
                if (PMS_SMTP_AUTH == 1) {
                    $mail->SMTPAuth = true;
                    $mail->Username = PMS_SMTP_USER;
                    $mail->Password = PMS_SMTP_PASS;
                }
                if (!empty(PMS_SMTP_SECURITY)) {
                    $mail->SMTPSecure = PMS_SMTP_SECURITY;
                }
            } else {
                $mail->isMail();
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
