<?php


/**
 * Hooks for BoilerPlate extension
 *
 * @file
 * @ingroup Extensions
 */

class BoilerPlateHooks {

    /**
     * Hook: NameOfHook
     *
     * @param string $arg1 First argument
     * @param bool $arg2 Second argument
     * @param bool $arg3 Third argument
     */
    public static function onPageContentSaveComplete( WikiPage $wikiPage, User $user, $content, $summary, $isMinor,
                                                      $isWatch, $section, $flags, $revision, $status, $baseRevId,
                                                      $undidRevId ) {
        //var_dump("Somebody edited something");
        return true;
        // Stub
    }

    public static function onBeforeCreateEchoEvent(
        &$notifications, &$notificationCategories, &$icons
    )
    {
        $notifications['article-notify'] = [
            'title-message' => 'boilerplate-helloworld',
            'title-params' => [],
            'flyout-message' => 'boilerplate-helloworld-intro',
            'email-subject-message' => 'boilerplate-helloworld-intro',
            'email-subject-params' => [],
            'email-body-batch-message'=> 'testform-subsection',
            'section' => 'alert',
            'formatter-class' => 'EchoBasicFormatter',
            'presentation-model' => 'ArticleNotifyPresentationModel'
        ];

    }

    public static function onEchoGetDefaultNotifiedUsers( $event, &$users ) {
        switch ( $event->getType() ) {
            case 'article-notify':
                $extra = $event->getExtra();
                if ( !$extra || !isset( $extra['to-be-notified-user-id'] ) ) {
                    break;
                }
//                $admins = User::findUsersByGroup('sysop');

                $recipientId = $extra['to-be-notified-user-id'];
                $recipient = User::newFromId( $recipientId );

                $users[$recipientId] = $recipient;
                break;
        }
        return true;
    }

    public static function onPageContentSave(WikiPage $wikiPage, User $user, $content, $summary, $isminor, $iswatch, $section) {

        if ( !class_exists( 'EchoEvent' ) ) {
            throw new Exception( 'Echo extension is not installed.' );
        }

        EchoEvent::create(
            [
                'type' => 'article-notify',
            ]
        );
        return true;

    }



}
