<?

namespace App\Contracts;

/**
 * [interface description]
 * @var [type]
 */
interface IParserShop
{
  public function setList($list = null);
  public function parseISBN();
  public function generateJSON();

}
