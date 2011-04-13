<?php

    class MenuLinksController extends AppController
    {
        function main()
        {
            $menulinks = $this->MenuLink->find('all', array('order' => 'MenuLink.position ASC'));

            if (!empty($this->params['requested']))
            {
                return $menulinks;
            }
            else
            {
                $this->set(compact('menulinks'));
            }
        }
    }

?>