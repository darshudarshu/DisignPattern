<?php
include "logger.php";
/**********************************************************************
 * @Discription : VISITOR DESIGN PATTERN
 *********************************************************************/
/**
 * interface accepts visitor object
 */
interface ItemElement
{
    public function accept(ShoppingCartVisitor $visitor);
}
/**
 * interface to add object to cart
 */
interface ShoppingCartVisitor
{
    public function visitBook(Book $book);
    public function visitFruit(Fruit $fruit);
}
class Book implements ItemElement
{
    private $price;
    private $isbnNumber;
    /**
     * constructor to initialize the book class members
     */
    public function __construct($cost, $isbn)
    {
        $this->price = $cost;
        $this->isbnNumber = $isbn;
    }
    /**
     * function to get the price of the book
     * @return price
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * function the get isbn no of the specific book
     * @return isbn number
     */
    public function getIsbnNumber()
    {
        return $this->isbnNumber;
    }
    /**
     * function accept the shopper
     * @return class current class object
     */
    public function accept(ShoppingCartVisitor $visitor)
    {
        return $visitor->visitBook($this);
    }
}
class Fruit implements ItemElement
{
    private $pricePerKg;
    private $weight;
    private $name;
     /**
     * constructor to initialize the fruit class members
     */
    public function __construct($priceKg, $weight, $name)
    {
        $this->pricePerKg = $priceKg;
        $this->weight = $weight;
        $this->name = $name;
    }
    /**
     * function to get the price of the book
     * @return price/kg 
     */
    public function getPricePerKg()
    {
        return $this->pricePerKg;
    } 
    /**
     * function to get the price of the book
     * @return weight
     */
    public function getWeight()
    {
        return $this->weight;
    }
    /**
     * function to get the price of the book
     * @return name 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * function accept the shopper
     * @return class current class object
     */
    public function accept(ShoppingCartVisitor $visitor)
    {
        return $visitor->visitFruit($this);
    }
}

class ShoppingCartVisitorImpl implements ShoppingCartVisitor
{
    /**
     * function to calculate the cost of books
     * @return cost 
     */
    public function visitBook(Book $book)
    {
        $cost = 0;
        /**
         * apply 5$ discount if book price is greater than 50
         */
        if ($book->getPrice() > 50) {
            $cost = $book->getPrice() - 5;
        } else {
            $cost = $book->getPrice();
        }
        echo "Book ISBN : " . $book->getIsbnNumber() . " cost = " . $cost . "\n";
        return $cost;
    }
    /**
     * function to calculate the cost of fruit
     * @return cost 
     */
    public function visitFruit(Fruit $fruit)
    {
        $cost = $fruit->getPricePerKg() * $fruit->getWeight();
        echo $fruit->getName() . " cost = " . $cost . "\n";
        return $cost;
    }
}
/**
 * client side
 */
class ShoppingCartClient
{
    /**
     * function to get the object and store it in array
     * @items array  of bought object
     */
    public function shop()
    {
        $items = array();
        echo "Enter no of items you want to Buy\n";
        //getting no of items and validating
        $noOfItems = ShoppingCartClient::getInt();
        for ($i = 0; $i < $noOfItems; $i++) {
            echo "Enter 1 : To Purchase BOOK \n";
            echo "Enter 2 : To Purchase Fruit \n";
            //getting type of item
            $choose = ShoppingCartClient::getInt();
            switch ($choose) {
                case 1:
                    echo "Enter \nBook Price : \nBook ISBN : \n";
                    $price = ShoppingCartClient::getInt();
                    $isbn = ShoppingCartClient::getInt();
                    //add object to the item array
                    $items[] = new Book($price, $isbn);
                    break;
                case 2:
                    echo "Enter \nFruit Price/kg : \nFruit weight :\nFruit name\n";
                    $priceOfFruit = ShoppingCartClient::getDouble();
                    $weight = ShoppingCartClient::getDouble();
                    $name = readline();
                    ///add object to the item array
                    $items[] = new Fruit($priceOfFruit, $weight, $name);
                    break;
                default:
                    echo "no such items present \n";
                    break;
            }
        }
        $total = ShoppingCartClient::calculatePrice($items);
        echo "Total Cost = " . $total . "\n";
    }
    /**
     * Static function calculate the cost of all objects
     * @var visitor holding the object of the ShoppingCartVisitorImpl class
     * @var sum temp var to add all the cost
     */
    private static function calculatePrice($items)
    {
        $visitor = new ShoppingCartVisitorImpl();
        $sum = 0;
        //iterating all over th array
        foreach ($items as $val) {
            $sum = $sum + $val->accept($visitor);
        }
        return $sum;
    }
    /**
     * function to validate integer 
     */
    public function getInt()
    {
        fscanf(STDIN, '%d', $num);
        if (filter_var($num, FILTER_VALIDATE_INT)) {
            return $num;
        } else {
            echo "enter valid number  \n";
            //recursion
            return ShoppingCartClient::getInt();
        }
    }
    /**
     * function to validate double value 
     */
    public function getDouble()
    {
        fscanf(STDIN, '%f', $num);
        if (filter_var($num, FILTER_VALIDATE_FLOAT)) {
            return $num;
        } else {
            echo "enter valid double value  \n";
            //recursion
            return ShoppingCartClient::getDouble();
        }
    }
}
/**
 * user
 */
$ref = new ShoppingCartClient();
$ref->shop();
