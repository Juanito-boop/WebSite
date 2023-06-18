<?php
use Supabase\CreateClient;

$client = new CreateClient('https://npuxpuelimayqrsmzqur.supabase.co', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU');

$bucketName = 'images';

$objects = $client->storage->from($bucketName)->__getUrl;

foreach ($objects['data'] as $object) {
    echo $object['name'] . "\n";
}
?>