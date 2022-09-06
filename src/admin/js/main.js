/**
 * Admin-facing scripts for <%= template.name %>
 * Include code inside classes to enforce use strict and prevent scope clash
 *
 * @since 1.0.0
 * @version 1.0.0
 */

/**
 * The main class for admin-facing scripts
 * 
 * @since 1.0.0
 * @version 1.00
 */
class <%= template.class %>Admin {
    // define class properties
    #pluginName

    /**
     * The admin constructor
     * 
     * @since 1.0.0
     * @version 1.0.0
    */
    constructor() {
        // define the plugin name
        this.pluginName = '<%= template.name %>'
    }
    
    /**
     * Run the admin code
     * 
     * @since 1.0.0
     * @version 1.0.0
     */
    run() {
        // add run code here
        console.log(`${this.pluginName} admin script is running...`)
    }
}

// create instance of admin class
const <%= template.class %>AdminScripts = new <%= template.class %>Admin()
// run admin class functions
<%= template.class %>AdminScripts.run()