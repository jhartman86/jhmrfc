VM_SETTINGS = {
	# How much power should the box have? Careful going too low
	# w/ the memory value if the box hasn't been provisioned yet;
	# MySQL 5.6+ is resource hungry and can get a little finicky.
	resources_values: {
		memory: 768,
		cpus: 	2,
	},

	# "Port In VM" => "Port On Your Host Machine"
	port_mappings: {
		443		=> 4433,
		3306	=> 3307
	},

	# Need some directories to have more promiscious permissions
	# (eg. in order to write to them)? Configure here. This should
	# be an array of dictionary objects, like [{...}, {...}].
	httpd_writable_dirs: [
		# -----------------------------------------------------------
		# Ex: If your project root structure looks like the following
		# (eg, Concrete5.7):
		# -----------------------------------------------------------
		#   root/
		#     ... other stuff ...
		#     web/
		#       ... other stuff ...
		#       application/
		#         ... other stuff ...
		#         files/
		# -----------------------------------------------------------
		# and you need the web/application/files directory to be
		# writable. Notice, the vm absolute path /home/vagrant/app/,
		# which is where the machine will mount your app automatically.
		# -----------------------------------------------------------
		# {
		# 	host_relative_path: '../web/application/files',
		# 	vm_absolute_path: '/home/vagrant/app/web/application/files',
		# 	owner: 'vagrant',
		# 	group: 'www-data',
		# 	mount_options: ['dmode=775,fmode=664']
	    # }
	]
}
