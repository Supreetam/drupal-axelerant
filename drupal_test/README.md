# Drupal Test Module

## How to use it

This drupal module creates a new field under Site Information Admin form and stores
a siteapikey value as a system configuration. This module also provides a URL
http://default/page_json/{siteapikey}/{nid} which gives a JSON representation of a
given node from Page content type when correct siteapikey value is provided matching
system configured value

## How it works

1. To store siteapikey value as a system configuration this module invokes a Site Information
form alter hook to create a new field alongwith a custom form submit handler for setting the
value into configuration

2. Providing JSON representation of a given node of Page content type is achieved by creating
a custom controller file mapped to aforesaid route for handling the required validation 
criteria and provide desired output.
