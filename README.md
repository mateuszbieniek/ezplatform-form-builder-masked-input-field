# ezplatform-form-builder-masked-input-field
## Description
Bundle provides masked field for the Form Builder in eZ Platform EE. 
Bundle is based on: https://github.com/RobinHerbots/Inputmask

## Installation
### 1. Enable EzPublishLegacyBundle and EzSystemsEzPlatformXmlTextFieldTypeBundle
Edit `app/AppKernel.php`, and add 
```
new MateuszBieniek\EzPlatformFormBuilderMaskedInputBundle\EzPlatformFormBuilderMaskedInputBundle(),
```
at the end of the `$bundles` array.
### 2. Install `mateuszbieniek/ezplatform-form-builder-masked-input-field`
```
composer require mateuszbieniek/ezplatform-form-builder-masked-input-field
```
