# CFS Validate Image Add-on

### Add Validate Image dimension field type for [Custom Field Suite](https://wordpress.org/plugins/custom-field-suite/).

#### Displays an alert and reject insertion to the image that does not meeting dimention requirements.:no_entry_sign: (Using [sweetalert.js](http://t4t5.github.io/sweetalert/))

#### Requirements
- - -
* Activation [Custom Field Suite](https://wordpress.org/plugins/custom-field-suite/) Plugin.

#### Installation
- - -

 1. `cd /path-to-your/wp-content/plugins/`
 2. `git clone git@github.com:sectsect/cfs-validate-image.git`  
 That's it:ok_hand:

#### Setting items
- - -
* min width
* min height
* max width
* max height
* Alert Text (`Image Dimention < Min Dimention`)
* Alert Text (`Image Dimention > Max Dimention`)
* Reject mime-type

#### Change log  
 * **1.1.0** - Add image mime type validation
 * **1.0.0** - Initial Release

Based on the [CFS Google Maps Add-on](https://github.com/mgibbs189/cfs-google-maps) by [Matt Gibbs](https://github.com/mgibbs189)
