<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;



class MailToPostAuthor extends Mailable

{

    use Queueable, SerializesModels;



    /**

     * Create a new message instance.

     *

     * @return void

     */

    public function __construct($data)

    {

        $this->data = $data;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        return $this->from('noreply@nosmercado.com', 'Nosmercado')

            ->subject('Bo advertencia a wordo publica!')

            ->view('layout.mail-to-post-author')->with('data', $this->data);

    }

}

