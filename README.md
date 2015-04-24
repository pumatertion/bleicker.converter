# Info #

Converter is a Container to register different kind of TypeConverterInterfaces

### Usage ###

* Register a TypeConverter with Converter::register('registrationFormDto', new RegistrationFormDtoConverter());
* Convert a source: Converter::convert($postData, RegistrationFormDtoConverter::class);
