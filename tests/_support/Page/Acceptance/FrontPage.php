<?php /** @noinspection PhpIllegalPsrClassPathInspection */
declare(strict_types=1);

namespace Page\Acceptance;

use AcceptanceTester;

final class FrontPage
{
    // include url of current page
    public static string $URL = '/';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */
    protected AcceptanceTester $acceptanceTester;

    public function __construct(AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route(string $param): string
    {
        return static::$URL . $param;
    }

    public function submitQuestion(string $question): void
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);
        $I->submitForm('body > form', [
            'question' => $question
        ]);
    }
}
