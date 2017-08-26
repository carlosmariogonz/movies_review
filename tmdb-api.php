<?php

include("controller/classes/data/Movie.php");
include("controller/classes/data/Person.php");
include("controller/classes/data/Role.php");
include("controller/classes/roles/MovieRole.php");
include("controller/classes/config/APIConfiguration.php");
include("controller/classes/config/Configuration.php");

class TMDB {

	#@var string url of API TMDB
	const _API_URL_ = "http://api.themoviedb.org/3/";

	#@var array of config parameters
	private $config;

	#@var array of TMDB config
    private $apiconfiguration;

	/**
	 * 	Construct Class
	 *
	 * 	@param array $cnf The necessary configuration
	 */
	public function __construct($config = null) {

		// Set configuration
		$this->setConfig($config);

		// Load the API configuration
		if (! $this->_loadConfig()){
			echo _("Unable to read configuration, verify that the API key is valid");
			exit;
		}
	}

	//------------------------------------------------------------------------------
	// Configuration Parameters
	//------------------------------------------------------------------------------

	/**
	 *  Set configuration parameters
	 *
	 * 	@param array $config
	 */
	private function setConfig($config) {
		$this->config = new Configuration($config);
	}

	/**
	 * 	Get the config parameters
	 *
	 * 	@return array $config
	 */
	private function getConfig() {
		return $this->config;
	}

	//------------------------------------------------------------------------------
	// Language
	//------------------------------------------------------------------------------

	/**
	 *  Set the language
	 *	By default english
	 *
	 * 	@param string $lang
	 */
	public function setLang($lang = 'en') {
		$this->getConfig()->setLang($lang);
	}

	/**
	 * 	Get the language
	 *
	 * 	@return string
	 */
	public function getLang() {
		return $this->getConfig()->getLang();
	}

	//------------------------------------------------------------------------------
	// Config
	//------------------------------------------------------------------------------

	/**
	 * 	Loads the configuration of the API
	 *
	 * 	@return boolean
	 */
	private function _loadConfig() {
		$this->_apiconfiguration = new APIConfiguration($this->_call('configuration'));

		return ! empty($this->_apiconfiguration);
	}

	/**
	 * 	Get Configuration of the API (Revisar)
	 *
	 * 	@return Configuration
	 */
	public function getAPIConfig() {
		return $this->_apiconfiguration;
	}

	//------------------------------------------------------------------------------
	// API Call
	//------------------------------------------------------------------------------

	/**
	 * 	Makes the call to the API and retrieves the data as a JSON
	 *
	 * 	@param string $action	API specific function name for in the URL
	 * 	@param string $appendToResponse	The extra append of the request
	 * 	@return string
	 */
	private function _call($action, $appendToResponse = '') {

		$url = self::_API_URL_.$action .'?api_key='. $this->getConfig()->getAPIKey() .'&language='. $this->getConfig()->getLang() .'&append_to_response='. implode(',', (array) $appendToResponse) .'&include_adult='. $this->getConfig()->getAdult();
		//var_dump($url);
		if ($this->getConfig()->getDebug()) {
			echo '<pre><a href="' . $url . '">check request</a></pre>';
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);

		$results = curl_exec($ch);

		curl_close($ch);

		return (array) json_decode(($results), true);
	}

	//------------------------------------------------------------------------------
	// Get Data Objects
	//------------------------------------------------------------------------------

	/**
	 * 	Get a Movie
	 *
	 * 	@param int $idMovie The Movie id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Movie
	 */
	public function getMovie($idMovie, $appendToResponse = null) {
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()->getAppender('movie');

		return new Movie($this->_call('movie/' . $idMovie, $appendToResponse));
	}

	/**
	 * 	Get a Person
	 *
	 * 	@param int $idPerson The Person id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Person
	 */
	public function getPerson($idPerson, $appendToResponse = null) {
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()->getAppender('person');

		return new Person($this->_call('person/' . $idPerson, $appendToResponse));
	}

	/**
	 *  Search Person
	 *
	 * 	@param string $personName The name of the Person
	 * 	@return Person[]
	 */
	public function searchPerson($personName){

		$persons = array();

		$result = $this->_call('search/person', '&query='. urlencode($personName));

		foreach($result['results'] as $data){
			$persons[] = new Person($data);
		}

		return $persons;
	}

	/**
	 *  Search Person
	 *
	 * 	@param string $personName The name of the Person
	 * 	@return Person[]
	 */
	public function searchMovie($movieName){

		$movies = array();

		$result = $this->_call('search/movie', '&query='. urlencode($movieName));

		foreach($result['results'] as $data){
			$movies[] = new Movie($data);
		}

		return $movies;
	}

}
?>
