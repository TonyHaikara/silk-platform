<?php

use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Features context. (MinkContext extends BehatContext)
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets its own context object.
     */
    public function __construct()
    {
    }

    /**
     * @Given /^I am a platform administrator$/
     */
    public function iAmAPlatformAdministrator()
    {
        $this->iAmLoggedAs('admin', 'admin');
    }

    /**
     * @Given /^I am an institution$/
     */
    public function iAmAnInstitution()
    {
        $this->iAmLoggedAs('institution', 'institution');
    }

    /**
     * @Given /^I am a final user$/
     */
    public function iAmAFinalUser()
    {
        $this->iAmLoggedAs('user', 'user');
    }

    /**
     * @Given /^I am logged as "([^"]*):([^"]*)"$/
     */
    public function iAmLoggedAs($username, $password)
    {
        // /logout sends to login automatically
        $this->visit('/logout');
        $this->fillField('email', $username);
        $this->fillField('password', $password);
        $this->pressButton('Sign in');
        $this->waitForThePageToBeLoaded();
    }

    /**
     * Checks, that element with specified CSS doesn't exist on page
     *
     * @Then /^(?:|I )should not see an error$/
     */
    public function iShouldNotSeeAnError()
    {
        $this->assertSession()->pageTextNotContains('Internal server error');
        $this->assertSession()->pageTextNotContains('error');
        $this->assertSession()->pageTextNotContains('Oops');
        //$this->assertSession()->elementNotExists('css', '.alert-danger');
    }

    /**
     * @Given /^I am not logged in$/
     */
    public function iAmNotLoggedIn()
    {
        $this->visit('/logout');
    }

    /**
     * @Then /^I fill in editor field "([^"]*)" with "([^"]*)"$/
     */
    public function iFillInWysiwygOnFieldWith($locator, $value)
    {
        // Just in case wait that ckeditor is loaded
        $this->getSession()->wait(2000);

        $el = $this->getSession()->getPage()->findField($locator);
        $fieldId = $el->getAttribute('id');

        if (empty($fieldId)) {
            throw new Exception(
                'Could not find an id for field with locator: '.$locator
            );
        }

        $this->getSession()->executeScript(
            "setContentFromEditor(\"$fieldId\", \"$value\");"
        );
    }

    /**
     * @Given /^I fill hidden field "([^"]*)" with "([^"]*)"$/
     */
    public function iFillHiddenFieldWith($field, $value)
    {
        $this->getSession()->getPage()->find(
            'css',
            'input[name="'.$field.'"]'
        )->setValue($value);
    }

    /**
     * @When /^(?:|I )confirm the popup$/
     */
    public function confirmPopup()
    {
        // See
        // https://gist.github.com/blazarecki/2888851
        /** @var \Behat\Mink\Driver\Selenium2Driver $driver Needed because no cross-driver way yet */
        $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();
    }

    /**
     * @When /^(?:|I )wait for the page to be loaded$/
     */
    public function waitForThePageToBeLoaded()
    {
        $this->getSession()->wait(4000);
    }

    /**
     * @When /^wait very long for the page to be loaded$/
     */
    public function waitVeryLongForThePageToBeLoaded()
    {
        $this->getSession()->wait(8000);
    }

    /**
     * @When /^wait the page to be loaded when ready$/
     */
    public function waitVeryLongForThePageToBeLoadedWhenReady()
    {
        $this->getSession()->wait(9000, "document.readyState === 'complete'");
    }

    /**
     * @When /^I check the "([^"]*)" radio button$/
     */
    public function iCheckTheRadioButton($radioLabel)
    {
        $radioButton = $this->getSession()->getPage()->findField($radioLabel);
        if (null === $radioButton) {
            throw new Exception("Cannot find radio button ".$radioLabel);
        }
        $this->getSession()->getDriver()->click($radioButton->getXPath());
    }

    /**
     * @When /^I check radio button with label "([^"]*)"$/
     */
    public function iCheckTheRadioButtonWithLabel($label)
    {
        $this->getSession()->executeScript("
            $(function() {
                $(':contains(\$label\")').parent().find('input').prop('checked', true);
            });
        ");
    }

     /**
     * Clicks link with specified id|title|alt|text
     * Example: When I follow "Log In"
     * Example: And I follow "Log In"
     *
     * @When /^(?:|I )focus "(?P<link>(?:[^"]|\\")*)"$/
     */
    public function focus($input)
    {
        $input = $this->getSession()->getPage()->findField($input);
        $input->focus();
    }

    /**
     * @Given /^I check the "([^"]*)" radio button with "([^"]*)" value$/
     */
    public function iCheckTheRadioButtonWithValue($element, $value)
    {
        $this->getSession()->executeScript("
            $(function() {
                $('input[type=\"radio\"][name=".$element."][value=".$value."]').prop('checked', true);
            });
        ");

        return true;
    }

    /**
     * @Given /^I check the "([^"]*)" radio button selector$/
     */
    public function iCheckTheRadioButtonBasedInSelector($element)
    {
        $this->getSession()->executeScript("
            $(function() {
                $('$element').prop('checked', true);
            });
        ");

        return true;
    }

    /**
     * @Then /^I should see an icon with title "([^"]*)"$/
     */
    public function iShouldSeeAnIconWithTitle($value)
    {
        $el = $this->getSession()->getPage()->find('xpath', "//img[@title='$value']");
        if (null === $el) {
            throw new Exception(
                'Could not find an icon with title: '.$value
            );
        }
        return true;
    }
    /**
     * @Then /^I should not see an icon with title "([^"]*)"$/
     */
    public function iShouldNotSeeAnIconWithTitle($value)
    {
        $el = $this->getSession()->getPage()->find('xpath', "//img[@title='$value']");
        if (null === $el) {
            return true;
        }
        return false;
    }

    /**
     * @Then /^I save current URL with name "([^"]*)"$/
     */
    public function saveUrlWithName($name)
    {
        $url = $this->getSession()->getCurrentUrl();
        $this->getSession()->setCookie($name, $url);
    }

    /**
     * @Then /^I visit URL saved with name "([^"]*)"$/
     */
    public function visitSavedUrlWithName($name)
    {
        $url = $this->getSession()->getCookie($name);
        echo $url;
        if (empty($url)) {
            throw new Exception("Url with name: $name not found");
        }
        $this->visit($url);
    }
}
