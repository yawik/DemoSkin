Feature: Application installed

  Scenario: Check installation
    Given I am on the homepage
    Then I should see "Welcome to YAWIK!"
    Given there is a user "test@example.com" identified by "test"
    When I want to log in
    And I specify the username as "test@example.com"
    And I specify the password as "test"
    And I log in
    And I should see "You are now logged in"
