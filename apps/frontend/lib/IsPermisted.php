<?php

/**
 * Description of IsPermisted
 *
 * @author Furqan Wasi
 */
class IsPermisted extends sfFilter {

    public function execute($filterChain) {
        $context = sfContext::getInstance();
        $user = $context->getUser();
        if ($user->getGuardUser()) {
            $IsMediaScoreAccess = $user->getGuardUser()->getMediascoreAccess();
            $ISMediaRiverAccess = $user->getGuardUser()->getMediariverAccess();
            $UserRole = $user->getGuardUser()->getRole();
            if (!$IsMediaScoreAccess && !$ISMediaRiverAccess && $UserRole != 1) {
                if (!isset($_GET['access_allow']) && empty($_GET['access_allow']) != 0) {
                    header('location: /index.php/sfGuardAuth/signout?access_allow=0');
                    exit;
                }
            }
        }
        $filterChain->execute();
    }

}

?>
