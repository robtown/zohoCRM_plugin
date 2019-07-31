# zohoCRM_plugin
Worpress plugin to handle oauth negotiation and accessing profile data from Zoho CRM and Zoho Books
Just getting things spun up. More to follow...
In the mean time you can copy these files  directly to wp-content/plugins and activate the plugin.
Go to the ZohoCRM option in your dashboard left nav and enter your Zoho API access settings.
And use the following shortcodes:
[zohoCRM] - Loads profile information from Zoho CRM Contacts and Zoho Books
[zohoCRM-oauthcallback] - You will need to make a page in your worpress site to use as a callback page for oauth token negotiation, put this shortcode on that page to handle the second step in acquiring the access token for the Zoho API's.
                          You will need to use this callback page's URL for your Zoho API access, both when you set up the API keys in zoho and in the worpress admin settings for the plugin.
[zohoCRM-editinfo] - Puts a form on the page to edit your Zoho profile info. Short code is there and operational, but still working on building the form.                          
