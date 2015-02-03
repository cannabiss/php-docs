<?php
class BoardController
{
    public function index()
    {
        $data['news'] = Board::getlastNews();
        View::loadTemplate('board', $data);
    }
}