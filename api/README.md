<p align="center" background="black"><img src="http://testnet.mintercat.com/static/img/icons/Cats.webp" width='100' height='100'></p>

## MinterCat | API
Welcome to the MinterCat project!<br>
The Developers section will help you develop your own app / bot / website with our cats, using our open API<br>
<br>
This document covers the installation and use of this API and often reveals answers to common problems and issues - read this document thoroughly if you are experiencing any difficulties. If you have any questions that are beyond the scope of this document, feel free to email at <b>admin@mintercat.com</b> Thank you so much!<br>

## About
* [API](#api)
* [Data base](#data-base)
* [Genes](#genes)
* [Explorer | Search by address](#explorer--search-by-address)
* [Explorer | Search by id](#explorer--search-by-id)
* [IMG](#img)
* [Coin price](#coin-price)
* [Users](#users)
* [Hash](#hash)
* [GitHub Files](#github-files)
* [Version](#version)

## API
<b>api.mintercat.com</b><br>
https://api.mintercat.com - API where you can get all existing types of cats, and also find out how many cats are purchased at the moment.<br>
<ul>
<li>count - the number of cats purchased at the moment.</li>
<li>cats - all existing types of cats.</li>
<li>gender - gender of the cat.</li>
<li>name - the Name of the breed.</li>
<li>series - release Series. The lower the series, the more expensive the cat.</li>
<li>rarity - Rarity. On how many rarely marks a particular cat. Multiply this result by 100 and get the value as a percentage.</li>
<li>img - serial number of the cat's avatar.</li>
To get an image of the cat's avatar, follow the link - mintercat.com/img/Cat <b><i>serial number of the cat's avatar</i></b> .webp
<li>count - The number of cats of this breed at the moment.</li>
<li>price - the recommended cost of this cat in the MINTERCAT coin.</li>
</ul>

## Data base
<b>api.mintercat.com/list</b><br>
All created cats are stored in the database, which can be obtained from the link https://api.mintercat.com/list<br>
<ul>
<li>stored_id - the block where the cat was created.</li>
<li>addr - owner of the cat at the moment.</li>
<li>id - serial number of the cat.</li>
<li>img - serial number of the cat's avatar.</li>
To get an image of the cat's avatar, follow the link - mintercat.com/img/Cat <b><i>serial number of the cat's avatar</i></b> .webp
<li>sale - if 1 - for sale; if 0 - not for sale.</li>
<li>price - the sale Price of the cats in the MINTERCAT coin.</li>
</ul>

## Genes
<b>api.mintercat.com/gen</b><br>
All genes of cats, which can be obtained from the link https://api.mintercat.com/gen<br>
<ul>
<li>stored_id - the block where the cat was created.</li>
<li>tentacles - gene for cats with octopus tentacles.</li>
<li>fishtail - gene for cats with fish tails.</li>
<li>horns - gene for cats with horns.</li>
  And so on.
</ul>

## Genes and Data base
<b>api.mintercat.com/gen/full</b><br>
The full database with the addition of cat genes can be obtained from this link https://api.mintercat.com/gen/full<br>

## Explorer | Search by address
<b>api.mintercat.com/cats?addr=Mx...</b><br>
All cats belonging to the same user, you can get it from the link https://api.mintercat.com/cats?addr=Mx...<br>
<ul>
<li>stored_id - the block where the cat was created.</li>
<li>addr - owner of the cat at the moment.</li>
<li>id - serial number of the cat.</li>
<li>img - serial number of the cat's avatar.</li>
To get an image of the cat's avatar, follow the link - mintercat.com/img/Cat <b><i>serial number of the cat's avatar</i></b> .webp
<li>sale - if 1 - for sale; if 0 - not for sale.</li>
<li>price - the sale Price of the cats in the MINTERCAT coin.</li>
</ul>

## Explorer | Search by id
<b>api.mintercat.com/cats?id=_</b><br>
Find out which user the cat belongs to, you can follow the link https://api.mintercat.com/cats?id=_ <b>block number</b><br>
<ul>
<li>stored_id - the block where the cat was created.</li>
<li>addr - owner of the cat at the moment.</li>
<li>id - serial number of the cat.</li>
<li>img - serial number of the cat's avatar.</li>
To get an image of the cat's avatar, follow the link - mintercat.com/img/Cat <b><i>serial number of the cat's avatar</i></b> .webp
<li>sale - if 1 - for sale; if 0 - not for sale.</li>
<li>price - the sale Price of the cats in the MINTERCAT coin.</li>
</ul>

# IMG
All images in the project are used in the format .webp<br>
<br>
To get an image of the cat's avatar, follow the link - mintercat.com/img/Cat <b><i>serial number of the cat's avatar</i></b> .webp<br>
<br>
Format .webp is supported by all browsers except Apple's Safari. For those who need png format, we have written a small utility, converting webp to png on the fly. Just instead<br>

```html
<img src="https://mintercat.com/img/Cat5.webp" width="350" height="350">
```
use
```html
<img src="https://mistercat.com/png.php?png=5" width="350" height="350">
```

## Coin price
<b>api.mintercat.com/coin</b><br>
MINTERCAT coin price relative to BIP https://api.mintercat.com/coin<br>
<ul>
<li>estimate - the price of a coin in BIP.</li>
<li>symbol - characteristics of the MINTERCAT coin in relation to BIP.</li>
<ul>
<li>name - name of the MINTERCAT coin</li>
<li>symbol - name of the MINTERCAT coin</li>
<li>volume - the cost of the coin excluding CRR</li>
<li>crr - name of the MINTERCAT coin</li>
The CRR is the most important parameter for any coin in the Minter network and is responsible for the level of its volatility (price variability).

The higher the constant ratio to the reserve , the smaller the difference between the value of the coin and the reserve that provides it. Accordingly, the higher the CRR indicator, the lower the volatility of the coin.
<li>reserve_balance - General reserve BIP.</li>
</ul>
</ul>

## Users
<b>api.mintercat.com/users</b><br>
Information about registered users https://api.mintercat.com/users<br>
<ul>
<li>address - address of the user's crypto wallet.</li>
<li>nick - nickname in the game.</li>
<li>language - user language.</li>
</ul>


## Hash
https://api.mintercat.com/hash<br>
hash - <b>0xc4bcf0eea760f882d17fe219ae217a4fdc06529530b14f98551ec0769694e44d</b> <i>(for an example)</i><br>
<br>
API for working with hash: https://api.mintercat.com/hash?hash=0xc4bcf0eea760f882d17fe219ae217a4fdc06529530b14f98551ec0769694e44d<br>
<br>
Here we see the cat block, from whom and to whom the cat was sent.<br>
<br>
<ul>
<li>height - The block where the cat is recorded.</li>
<li>tx.from - Sender of the transaction.</li>
<li>tx.to - Recipient of the transaction.</li>
API for working with hash: https://api.mintercat.com/hash?hash=0xc4bcf0eea760f882d17fe219ae217a4fdc06529530b14f98551ec0769694e44d&img=true
<br><br>
Here we see the transaction type and appearance of the cat.<br>
<br>
<li>type - Transaction type.</li>
<ul>
<li>type 1: Creating a cat</li>
<li>type 2: Transferring data between users</li>
<li>type 3: The crossing</li>
<li>type 4: Selling a cat</li>
<li>type 5: Buying a cat</li>
<li>type 6: Deleting</li>
 </ul>
<li>img - Serial number of the cat's avatar.</li>
  To get an image of the cat's avatar, follow the link:<br> mintercat.com/img/Cat <b><i>serial number of the cat's avatar</i></b>  .webp<br>
<li>hash - Hash transactions.</li>
</ul>

## GitHub Files
<b>api.mintercat.com/files</b><br>
The latest build of the project uploaded to github https://api.mintercat.com/files<br>

## Version
<b>api.mintercat.com/version</b><br>
The current version of the components of the project https://api.mintercat.com/version<br>
