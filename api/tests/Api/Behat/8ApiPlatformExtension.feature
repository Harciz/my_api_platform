# features/user.feature
Feature: User API
  Scenario: Create new user
    Given I am an anonymous user
    When I send a POST request to "/users" with body:
      """
      {
        "name": "BDDUser",
        "email": "bdd@example.com"
      }
      """
    Then the response status code should be 201
    And the response should contain "bdd@example.com"

    # behat.yml
default:
  extensions:
    ApiPlatform\Behat\ApiPlatformExtension: ~