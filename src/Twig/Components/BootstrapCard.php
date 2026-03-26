<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class BootstrapCard
{

    private string $_strTitle;
    private string $_strImg;
    private string $_strLink;
    private string $_strLabel;


    public function mount(string $title, string $img, string $link, string $label) {

        $this->_strTitle = $title;
        $this->_strImg   = $img;
        $this->_strLink  = $link;
        $this->_strLabel = $label;
        
    }

    /**
    * 
    */
    public function getTitle(): string 
    {
        return $this->_strTitle;
    }

    /**
    * 
    */
    public function getImg(): string 
    {
        return $this->_strImg;
    }

     /**
    * 
    */
    public function getLink(): string 
    {
        return $this->_strLink;
    }

     /**
    * 
    */
    public function getLabel(): string 
    {
        return $this->_strLabel;
    }



}
