## Views List Drupal Rest API resource

Was coded as an exercise [in response to this question in stackexchange ](https://drupal.stackexchange.com/questions/277586/export-json-sitemap-of-views).

## How to use
- enable the module 
- visit `views_list_json/views_list` you should get a response like
 ```
{
    view_id: "block_content",
    displays: [
        {
            id: "default"
        },
        {
            id: "page_1"
        }
    ]
    },
    {
        view_id: "comment",
        displays: [
        {
            id: "default"
        },
        {
            id: "page_published"
        },
        {
            id: "page_unapproved"
        }
    ]
},
 ```

## More information
- [Custom rest resource](https://www.drupal.org/docs/8/api/restful-web-services-api/custom-rest-resources)
