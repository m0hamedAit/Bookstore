<?php 

namespace App\Entity;

class PropertySearch{
  private $keyword;
  private $dateFrom;
  private $dateTo;

  public function setKeyword(string $keyword): PropertySearch
  {
    $this->keyword = $keyword;
    return $this;
  }

  public function getKeyword(): ?string
  {
    return $this->keyword;
  }
  

  public function setdateFrom(?\DateTimeInterface $dateFrom): PropertySearch
  {
    $this->dateFrom = $dateFrom;
    return $this;
  }

  public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function setdateTo(?\DateTimeInterface $dateTo): PropertySearch
    {
      $this->dateTo = $dateTo;
      return $this;
    }
  
    public function getDateTo(): ?\DateTimeInterface
      {
          return $this->dateTo;
      }


    
  



}
