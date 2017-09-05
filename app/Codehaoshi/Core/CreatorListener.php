<?php namespace Codehaoshi\Core;

interface CreatorListener
{
    public function creatorFailed($errors);
    public function creatorSucceed($model);
}
