Feature: Login with different user types

  Scenario: Login as admin user successfully
    Given I am on "/logout"
    And I should see "Sign in"
    When I fill in "admin" for "email"
    And I fill in "admin" for "password"
    And I press "Sign in"
    And wait for the page to be loaded
    Then I should not see an error

  Scenario: Login as institution successfully
    Given I am on "/logout"
    And I should see "Sign in"
    When I fill in "institution" for "email"
    And I fill in "institution" for "password"
    And I press "Sign in"
    And wait for the page to be loaded
    Then I should not see an error

  Scenario: Login as final user successfully
    Given I am on "/logout"
    And I should see "Sign in"
    When I fill in "user" for "email"
    And I fill in "user" for "password"
    And I press "Sign in"
    And wait for the page to be loaded
    Then I should not see an error
