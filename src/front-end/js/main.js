/**
 * Front-end-facing scripts for <%= template.name %>
 * Include code inside classes to enforce use strict and prevent scope clash
 *
 * @since 1.0.0
 * @version 1.0.0
 */

/**
 * The main class for front-end-facing scripts
 * 
 * @since 1.0.0
 * @version 1.00
 */
class <%= template.class %>FrontEnd {
    // define class properties
    #pluginName

    /**
     * The front-end constructor
     * 
     * @since 1.0.0
     * @version 1.0.0
     */
    constructor() {
         // define the plugin name
        this.pluginName = '<%= template.name %>'
    }
    /**
     * Run the front-end code
     * 
     * @since 1.0.0
     * @version 1.0.0
     */
    run() {
        // add run code here
        console.log(`${this.pluginName} front-end script is running...`)
    }
}

// create instance of front-end class
const <%= template.class %>FrontEndScripts = new <%= template.class %>FrontEnd()
// run front-end class functions
<%= template.class %>FrontEndScripts.run()