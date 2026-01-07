
  GET|HEAD        / .......................................................................................................... login › LoginController@login
  POST            _ignition/execute-solution ................................. ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController
  GET|HEAD        _ignition/health-check ............................................. ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST            _ignition/update-config .......................................... ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  GET|HEAD        api/user ................................................................................................................................. 
  GET|HEAD        area-list ............................................................................................ area.list › AreaController@getAreas
  GET|HEAD        areas ................................................................................................. areas.index › AreaController@index
  POST            areas ................................................................................................. areas.store › AreaController@store
  GET|HEAD        areas/create ........................................................................................ areas.create › AreaController@create
  GET|HEAD        areas/{area} ............................................................................................ areas.show › AreaController@show
  PUT|PATCH       areas/{area} ........................................................................................ areas.update › AreaController@update
  DELETE          areas/{area} ...................................................................................... areas.destroy › AreaController@destroy
  GET|HEAD        areas/{area}/edit ....................................................................................... areas.edit › AreaController@edit
  GET|HEAD        dashboard .................................................................................... dashboard.index › DashboardController@index
  POST            dashboard .................................................................................... dashboard.store › DashboardController@store
  GET|HEAD        dashboard/create ........................................................................... dashboard.create › DashboardController@create
  GET|HEAD        dashboard/{dashboard} .......................................................................... dashboard.show › DashboardController@show
  PUT|PATCH       dashboard/{dashboard} ...................................................................... dashboard.update › DashboardController@update
  DELETE          dashboard/{dashboard} .................................................................... dashboard.destroy › DashboardController@destroy
  GET|HEAD        dashboard/{dashboard}/edit ..................................................................... dashboard.edit › DashboardController@edit
  POST            do-forgotpassword .................................................................. do.forgot.password › LoginController@doForgotPassword
  POST            do-login .............................................................................................. do.login › LoginController@doLogin
  POST            do-reset-password .................................................................... do.reset.password › LoginController@doResetPassword
  GET|HEAD        export-areas ......................................................................................... area.export › AreaController@export
  GET|HEAD        export-localities ............................................................................ locality.export › LocalityController@export
  GET|HEAD        export-property ...................................................................... property.export › PropertyController@exportProperty
  GET|HEAD        export-property-type ..................................................... propertyType.export › PropertyTypeController@exportPropertyType
  GET|HEAD        export-vendor .............................................................................. vendor.export › VendorController@exportVendor
  GET|HEAD        forgot-password ......................................................................... forgot.password › LoginController@forgotPassword
  GET|HEAD        get-by-company/{company_id?} ............................................................. area.getbycompany › AreaController@getByCompany
  POST            import-area .......................................................................................... import.area › AreaController@import
  POST            import-locality .............................................................................. import.locality › LocalityController@import
  POST            import-property ...................................................................... import.property › PropertyController@importProperty
  POST            import-property-type ..................................................... import.propertytype › PropertyTypeController@importPropertyType
  POST            import-vendor .............................................................................. import.vendor › VendorController@importVendor
  GET|HEAD        locality ....................................................................................... locality.index › LocalityController@index
  POST            locality ....................................................................................... locality.store › LocalityController@store
  GET|HEAD        locality-list ........................................................................... locality.list › LocalityController@getLocalities
  GET|HEAD        locality/create .............................................................................. locality.create › LocalityController@create
  GET|HEAD        locality/{locality} .............................................................................. locality.show › LocalityController@show
  PUT|PATCH       locality/{locality} .......................................................................... locality.update › LocalityController@update
  DELETE          locality/{locality} ........................................................................ locality.destroy › LocalityController@destroy
  GET|HEAD        locality/{locality}/edit ......................................................................... locality.edit › LocalityController@edit
  GET|HEAD        property ....................................................................................... property.index › PropertyController@index
  POST            property ....................................................................................... property.store › PropertyController@store
  GET|HEAD        property-list ........................................................................... property.list › PropertyController@getProperties
  GET|HEAD        property/create .............................................................................. property.create › PropertyController@create
  GET|HEAD        property/{property} .............................................................................. property.show › PropertyController@show
  PUT|PATCH       property/{property} .......................................................................... property.update › PropertyController@update
  DELETE          property/{property} ........................................................................ property.destroy › PropertyController@destroy
  GET|HEAD        property/{property}/edit ......................................................................... property.edit › PropertyController@edit
  GET|HEAD        propertyType-list ............................................................ property_type.list › PropertyTypeController@getPropertyType
  GET|HEAD        property_type ......................................................................... property_type.index › PropertyTypeController@index
  POST            property_type ......................................................................... property_type.store › PropertyTypeController@store
  GET|HEAD        property_type/create ................................................................ property_type.create › PropertyTypeController@create
  GET|HEAD        property_type/{property_type} ........................................................... property_type.show › PropertyTypeController@show
  PUT|PATCH       property_type/{property_type} ....................................................... property_type.update › PropertyTypeController@update
  DELETE          property_type/{property_type} ..................................................... property_type.destroy › PropertyTypeController@destroy
  GET|HEAD        property_type/{property_type}/edit ...................................................... property_type.edit › PropertyTypeController@edit
  GET|HEAD        reset-password/{token} .................................................................... reset.password › LoginController@resetPassword
  GET|HEAD        sanctum/csrf-cookie .................................................... sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show
  GET|HEAD        vendor-list .................................................................................... vendor.list › VendorController@getVendors
  GET|HEAD        vendors ........................................................................................... vendors.index › VendorController@index
  POST            vendors ........................................................................................... vendors.store › VendorController@store
  GET|HEAD        vendors/create .................................................................................. vendors.create › VendorController@create
  GET|HEAD        vendors/{vendor} .................................................................................... vendors.show › VendorController@show
  PUT|PATCH       vendors/{vendor} ................................................................................ vendors.update › VendorController@update
  DELETE          vendors/{vendor} .............................................................................. vendors.destroy › VendorController@destroy
  GET|HEAD        vendors/{vendor}/edit ............................................................................... vendors.edit › VendorController@edit

                                                                                                                                         Showing [69] routes

