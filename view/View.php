<?php
class View{
    //ATTRIBUT
    private array $data = [];
    private string $messageError = "";

    //CONSTRUCT
    
    // #region GETTER ET SETTER
    /**
     * Get the value of data
     *
     * @return array
     */
    public function getData(): array {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param array $data
     *
     * @return self
     */
    public function setData(array $data): self {
        $this->data = $data;
        return $this;
    }

    /**
     * Get the value of messageError
     *
     * @return string
     */
    public function getMessageError(): string {
        return $this->messageError;
    }

    /**
     * Set the value of messageError
     *
     * @param string $messageError
     *
     * @return self
     */
    public function setMessageError(string $messageError): self {
        $this->messageError = $messageError;
        return $this;
    }
    // #endregion
    //METHOD
    public function display(): void{

    }
    
}