<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *     Copyright (C) 2012  Dan Murfitt
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 * 
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * This is the range of numbers that the mathcaptcha can convert to words. If
 * you are using a custom language file with a greater range then please modify
 * appropriately.
 */
define('MATHCAPTCHA_NUMERIC_TEXT_RANGE_LOW',        0);
define('MATHCAPTCHA_NUMERIC_TEXT_RANGE_HIGH',       100);

/**
 * The number of phrases to randomly choose from. If you would like to add more,
 * simply adjust these numbers. If you would like to use only one phrase, change
 * the following number(s) to 1 and remove the unnecessary phrases from the
 * language file. The phrase will be randomly selected for each CAPTCHA question.
 */
define('MATHCAPTCHA_NUM_ADDITION_PHRASES',          5);
define('MATHCAPTCHA_NUM_MULTIPLICATION_PHRASES',    5);

Class Mathcaptcha
{
    /**
     * Store the CodeIgniter super-object
     * @var object $ci 
     */
    private $ci;
    
    /**
     * Store the language the math captcha should be displayed in
     * @var string CodeIgniter language setting
     */
    private $language;
   
    /**
     * The type of operation that should be performed for the math captcha
     * @var string 'addition', 'multiplication' or 'random'
     */
    private $operation;
    
    /**
     * The format of the numbers in the question
     * @var string 'numeric', 'word' or 'random' 
     */
    private $question_format;
    
    /**
     * The format of the number should be in the answer
     * @var string 'numeric', 'word' or 'either'
     */
    private $answer_format;
    
    public function __construct() 
    {    
        //Get the CodeIgniter super object
        $this->ci =& get_instance();
    }
    
    /**
     * Initialise the library, gather the config (if set) and start the process
     * of calculating the math captcha
     * @param array $config An array of config items
     * @return boolean TRUE if successful, FALSE if not
     */
    public function init($config = array())
    {
        //Load the appropriate language file
        if (isset($config['language']))
        {
            //Use the specified language
            $this->language = $config['language'];
        }
        else
        {
            //Go with the default application language
            $this->language = $this->ci->config->item('language');
        }
        $this->ci->lang->load('mathcaptcha', $this->language);

        
    }
    
    /**
     * Gets the question to ask for the math captcha question
     * @return string|boolean The question to ask the user or FALSE if there was a problem
     */
    public function get_question()
    {
        
    }
    
    /**
     * Checks to see if the answer was correct against the captcha stored in flashdata memory
     * @param int $answer The answer to the captcha question
     * @return boolean TRUE if the answer was correct, FALSE if not or if there was a problem
     */
    public function check_answer($answer)
    {
        
    }
    
    /**
     * Converts a number to a language specific word
     * @param int $number The numeric version of the number
     * @return string The language specific word for the number or FALSE if there was a problem
     */
    private function numeric_to_string($number)
    {
        if (is_numeric($number) && $number >= MATHCAPTCHA_NUMERIC_TEXT_RANGE_LOW && $number <= MATHCAPTCHA_NUMERIC_TEXT_RANGE_HIGH)
        {
            return $this->ci->lang->line('mathcaptcha_numeric_word_'.$number);
        }
        else
        {
            return FALSE;
        }
    }
}

/* End of file mathcaptcha.php */
/* Location: ./application/libraries/mathcaptcha.php */