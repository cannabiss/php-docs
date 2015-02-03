<?php
class ErrorController
{

    public function index()
    {
        View::loadTemplate('error', $this->error);
    }
}