#tests/functional/features/home_page.feature

Feature: Home Page for Roman Numerals
  In order to show a functional page immediately
  As a new User
  I can access a page that routes through Zend Framework 2

  Scenario: View the Home Page
    When I go to "/"
    Then I should see "Coding Kata: Roman Numerals"
