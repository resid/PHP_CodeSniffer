<?php
/**
 * Warns about the use of debug code.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer_MySource
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   CVS: $Id: DebugCodeSniff.php 265159 2008-08-20 05:37:21Z squiz $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Warns about the use of debug code.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer_MySource
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class MySource_Sniffs_Debug_DebugCodeSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_DOUBLE_COLON);

    }//end register()


    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $className = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);
        if (strtolower($tokens[$className]['content']) === 'debug') {
            $method     = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
            $methodName = $tokens[$method]['content'];
            $error      = "Call to debug function Debug::$methodName() must be removed";
            $phpcsFile->addError($error, $stackPtr);
        }

    }//end process()


}//end class

?>