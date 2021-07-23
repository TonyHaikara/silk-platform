Feature: Access to all pages as admin

  Scenario: Login as admin and access Dashboard
    Given I am an admin
    When I wait for the page to be loaded
    Then I should not see an error
    And I should see "Dashboard"
    And I should see "Tasks"
    And I should see "Jobs"
    And I should see "Skills"
    And I should see "Training"
    And I should see "Users"
    And I should see "My account"

  Scenario: See Dashboard tab elements
    Given I am an admin
    When I load the tab with id "#home-tab"
    Then I should see "Mark selected as read"
    And I should see "Date"
    #And I should see "No data available"

  Scenario: See Tasks tab elements
    Given I am an admin
    #And wait very long for the page to be loaded
    When I load the tab with id "#tasks-tab"
    Then I should see "Name"
    And I should see "Registered on"

  Scenario: See Jobs tab elements
    Given I am an admin
    When I load the tab with id "#work-tab"
    Then I should see "label"
    And I should see "3D animator"
    And I should see "See related trainings"

  Scenario: See Skills tab elements
    Given I am an admin
    When I load the tab with id "#skill-tab"
    Then I should see "Label"
    And I should see "3D body scanning technologies"
    And I should see "See related trainings"