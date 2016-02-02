VM_SETTINGS = {
	resources_values: {
		memory: 768,
		cpus: 	2,
	},

	port_mappings: {
		3306 => 3307
	},

	# See Vagrantfile for definition
	httpd_writable_dirs: [
		{ # Ex. for setting up a writable directory for Concrete5
			host_relative_path: '../web/application/files',
			vm_absolute_path: '/home/vagrant/app/web/application/files',
			owner: 'vagrant',
			group: 'www-data',
			mount_options: ['dmode=775,fmode=664']
	    },
	    { # Ex. for setting up a writable directory for Concrete5
            host_relative_path: '../web/application/config',
            vm_absolute_path: '/home/vagrant/app/web/application/config',
            owner: 'vagrant',
            group: 'www-data',
            mount_options: ['dmode=775,fmode=664']
        },
        { # Ex. for setting up a writable directory for Concrete5
            host_relative_path: '../web/packages',
            vm_absolute_path: '/home/vagrant/app/web/packages',
            owner: 'vagrant',
            group: 'www-data',
            mount_options: ['dmode=775,fmode=664']
        }
	]
}