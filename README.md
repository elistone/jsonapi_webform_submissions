# JSON:API Webform Submissions

Webform submission endpoints do not include the submission data, i.e the information about what was submitted.

This module adds a new field to the endpoint that contains this information.

There are limitations such as you cannot filter or sort by this data (as it is not in the database)

## Requirements
* JSON:API
* [JSON:API Extras](https://www.drupal.org/project/jsonapi_extras)

## How to use
1. Install this module
1. Navigate to: admin/config/services/jsonapi/resource_types
1. Find a webform submission endpoint
1. On the field submission_data go to the advance section
1. Change Enhancer to "Webform submission data (Unserialize data)"