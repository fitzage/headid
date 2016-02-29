# HeadID

## Basic Functionality

This is a kirbytext extension plugin for the [Kirby CMS](https://getkirby.com) that primarily does two things:

1. It adds an ID element to all header tags within content fields that are parsed by kirbytext, making them linkable with hashes in the URL.
2. It adds a link to the header tag so clicking it takes you to the permalink for that header, allowing you to copy it for use elsewhere. You could then also use some styling and/or scripting to do additional things here, like allowing automatic copying of the link.

## Edge Cases

I've tried to handle a variety of edge cases that we found necessary with our testing.

1. If an ID has been manually added, it will be preserved, because we assume someone might already be linking to that ID.
2. If a named anchor has been manually added, we remove it but we use that name for the new ID element, again because someone might already be linking to it.

## Installation

Simply drop the headid.php file in the `/site/plugins` folder in your Kirby installation. If that folder doesn't exist, create it.

There are config options mentioned below, but these are not necessary to use the plugin. It will default to my preferred settings.

## Configuration

The plugin works by taking the text content of your ID tag and stripping out or replacing unwanted characters to create the ID. The `$delete` and `$hyphenate` variables have what I would consider sane defaults that work for my needs, but you can change them in your config file.

Anything in the `$delete` array will be deleted from the original text when creating the ID. Anything in the `$hyphenate` array will be replaced with a hyphen when creating the ID.

To modify these arrays, add the following lines to your config.php:

```
c::get('headid-delete', array(':','(',')','?','.','!','$',',','%','^','&',"'",';','"','[',']','{','}','|','`','#'));
c::get('headid-hyphenate', array(' ','~','@','*','+','=','/','>','<'));
```

Once these lines are in your config file, you can tweak them as desired and they will override the defaults.
