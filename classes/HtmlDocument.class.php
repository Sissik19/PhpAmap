<?php
class HtmlDocument{
	protected $mainFilePath; //String C:\xampp\htdocs\PHP\boat.inc.php
	protected $templateName; //Nom du template (default, mobile, ...) correspondant au nom du repertoire sous templates/
	protected $headers; //table de lignes html contenant les headers du document HTML(balise <head>)
	protected $mainContent; //Chaîne html contenant la partie <main>
	protected $bodyContent; //Chaîne HTML contenant la partie <body>
	private static $currentInstance;
    const FIRST = 'FIRST';
    const LAST = 'LAST';

	public function __construct($fileName){
		self::$currentInstance = $this;
		if(preg_match('#[\w/\-]+#',$fileName)){
		    //(!strpbrk($_GET['page'], ".<>!?:/")
            //[\.|<|>|\!|\?]
            $this->mainFilePath = __DIR__.'/../pages/'.$fileName.'.inc.php';


        }
        else{
            $this->mainFilePath = __DIR__.'/../pages/index.inc.php';
        }

		$this->headers = array();
        $this->parseMain();
	}


	protected function parseMain(){
		ob_start();
		try {
            include($this->mainFilePath);
        }
        catch (PageInexistanteException $e){
		    ob_clean();
		    include(__DIR__.'/../pages/error404.inc.php');
        }
        $this->mainContent = ob_get_clean();
	}

	protected function parseTemplate(){
        ob_start();
        include (__DIR__.'/../templates/'.$this->templateName.'/template.php');
	    $this->bodyContent = ob_get_clean();
	}
	public function applyTemplate($templateName){
        $this->templateName = $templateName;
        $this->headers = [];
        $this->parseTemplate();
	}
	public function render(){
	    echo '<!DOCTYPE html>';
        echo '<html>';
        echo '<head>';
        foreach ($this->headers as $key => $value){
            echo $value;
        }
        echo '</head>';
        echo '<body>';
        echo $this->bodyContent;
        echo '</body>';
        echo '</html>';
	}
	public function addHeader($html, $position){
	    if($position == self::LAST)
            array_push($this->headers, $html);
	    else if($position == self::FIRST){
            array_unshift($this->headers, $html);
        }
        else{
            array_push($this->headers, $html);
        }
	}

    public function isHeaderSet($idBalise){
      return isset($this->headers[$idBalise]);
    }

    public function addUniqueHeader($idBalise, $html){
        $this->headers[$idBalise] = $html;
    }

	public function getMainContent(){
		return $this->mainContent;
	}
	public static function getCurrentInstance(){
	    /*if(self::$currentInstance === null){
	        self::$currentInstance = new HtmlDocument();
        }*/
		return self::$currentInstance;
	}


}

?>