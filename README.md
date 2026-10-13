A simple content accordion for Silverstripe elemental

By default, this uses the HTML5 `<details>` tag for the accordion, providing native support and accessibility out of the box.
The tag supports styling and emits event listeners on interaction

https://developer.mozilla.org/en-US/docs/Web/HTML/Element/details
## FAQ structured data

When **Mark up as FAQ for search engines** is enabled, the accordion emits FAQPage structured data. If `dorsetdigital/silverstripe-schema-manager` is installed and a current page is available, the accordion registers its questions with Schema Manager instead. Schema Manager includes them in its page-level JSON-LD graph in the document head; no inline FAQ script is added.

Schema Manager is an **optional** integration. Without it, the accordion continues to output its existing standalone FAQPage JSON-LD markup. Only enable the FAQ setting for genuine questions and answers, and use at most one FAQ accordion per page (Schema Manager identifies a FAQPage by page URL).
