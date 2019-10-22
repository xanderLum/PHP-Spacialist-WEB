<?php

 require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'ap1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'eb6ffe9cf06d0c047e3a',
    '35bd438facd807fb7a22',
    '683437',
    $options
  );