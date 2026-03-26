<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class BootstrapButton
{
    private string $_strText;
    private string $_strType = "";
    private string $_strLink;

    /**
     * 
     */
    public function mount(string $text, string $type, string $link, bool $outlined = false): void 
    {
        $this->_strText = $text;
        $this->_strLink = $link;

        if($outlined)
        {
            $this->_strType = 'outline-';
        }
        
        $this->_strType .= $type;
    }

    /**
    * 
    */
    public function getText(): string 
    {
        return $this->_strText;
    }

    /**
    * 
    */
    public function getType(): string 
    {
        return $this->_strType;
    }

    /**
    * 
    */
    public function getLink(): string 
    {
        return $this->_strLink;
    }

}

