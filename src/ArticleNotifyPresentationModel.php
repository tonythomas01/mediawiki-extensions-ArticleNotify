<?php

class ArticleNotifyPresentationModel extends EchoEventPresentationModel {
    /**
     * {@inheritdoc}
     */
    public function getIconType() {
        return 'placeholder';
    }

    /**
     * {@inheritdoc}
     */
    public function getPrimaryLink() {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaderMessage() {
        $msg = parent::getHeaderMessage();

        return $msg;
    }
}