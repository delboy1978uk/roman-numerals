#tests/functional/features/roman_numerals.feature

Feature: Roman Numerals
  In order to ensure everything is functioning
  As a new User
  I am able to do the following

  Scenario: View the JSON service
    When I go to "/roman-numerals"
    Then I should get a response
    And the response should be JSON

  Scenario Outline: Convert Numbers
    Given I can convert the number "<number>" to "<numerals>"
  Examples:
    | number | numerals |
    |1|   I      |
    |  2     |   II     |
    |  3     |   III    |
    |  4     |   IV     |
    |  5     |   V      |
    |  6     |   VI     |
    |  7     |   VII    |
    |  8     |   VIII   |
    |  9     |   IX     |
    |  10    |   X      |
    |  11    |   XI     |
    |  12    |   XII    |
    |  13    |   XIII   |
    |  14    |   XIV    |
    |  15    |   XV     |
    |  16    |   XVI    |
    |  17    |   XVII   |
    |  18    |   XVIII  |
    |  19    |   XIX    |
    |  20    |   XX     |
    |  47    |   XLVII  |
    |  50    |   L      |
    |  99    |   XCIX   |
    |  100   |   C      |
    |  101   |   CI     |
    |  168   |   CLXVIII|
    |  257   |   CCLVII |
    |  569   |   DLXIX  |
    |  810   |   DCCCX  |
    |  999   |   CMXCIX |
    |  1000  |   M      |
    |  2048  | MMXLVIII |
    |  3192  | MMMCXCII |
    |  3999  | MMMCMXCIX|

  Scenario Outline: Convert Numbers
    Given I can convert the numerals "<numerals>" to "<number>"
  Examples:
    | numerals  | number |
    |  CMXCIX   |   999  |
    |  MMMCMXCIX|   3999 |
    |  CCLVII   |   257  |
    |  XVIII    |   18   |
    |  CCLVII   |   257  |
    |  XLVII    |   47   |

