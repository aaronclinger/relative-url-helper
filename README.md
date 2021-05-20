# A Relative to Absolute URL Helper

`relative_url_helper.php` is a [CodeIgniter](http://ellislab.com/codeigniter) helper for converting a relative URL path to an absolute URL. If you are not using CodeIgniter you can also use the function in isolation; **there are no CodeIgniter dependencies**.

This helper can be used freely for any open source or commercial works and is released under a [BSD licence](http://en.wikipedia.org/wiki/BSD_licenses).

## Syntax

### Description

> **relative_to_absolute_url** ( string _$host_ , string _$path_ )

### Parameters

> * _$host_ - A string containing a full URL that the path is relative to.
> * _$path_ - The relative string to convert.

## Usage

Here is a basic usage example on how to convert/transform a relative URL into an absolute URL:

```php
echo relative_to_absolute_url('http://example.com/folder1/folder2/file.html', '../page.html');
```
The above example will output:

`http://example.com/folder1/page.html`

---

Relative URL helper also handles complex and unrealistic relative URLs:

```php
echo relative_to_absolute_url('http://example.com/folder1/folder2/file.html', '.././folder3/./page.html');
```
The above example will output:

`http://example.com/folder1/folder3/page.html`

## Author

[Aaron Clinger](https://aaronclinger.com)
