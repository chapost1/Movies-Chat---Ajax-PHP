<?php

class message {

    public $message_id;
    public $from_user;
    public $to_user;
    public $messageCont;
    public $date;
    public $time;

    function __construct($message_id, $from_user, $to_user, $messageCont, $date, $time) {
        if (!($message_id === "")) {
            $this->message_id = $message_id;
        };
        $this->from_user = $from_user;
        $this->to_user = $to_user;
        $this->messageCont = $messageCont;
        $this->date = $date;
        $this->time = $time;
    }

}
