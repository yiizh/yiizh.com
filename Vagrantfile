# -*- mode: ruby -*-
# vi: set ft=ruby :

domains = {
  frontend: 'www.dev.yiizh.com',
}

Vagrant.configure(2) do |config|

  config.vm.box = "yiizh/php-7.0"
  config.vm.hostname = "yiizh.dev"

  config.vm.provider "virtualbox" do |v|
    v.memory = 1024
  end

  config.vm.network 'private_network', ip: "192.168.17.117"

  # disable folder '/vagrant' (guest machine)
  config.vm.synced_folder ".", "/vagrant", type: "nfs"
  config.vm.synced_folder "C:/Cache/composer", "/home/vagrant/.cache/composer", type: "nfs"

  config.vm.provision :hostmanager
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.hostmanager.manage_guest = true
  config.hostmanager.ignore_private_ip = false
  config.hostmanager.include_offline = false
  config.hostmanager.aliases = domains.values

  config.hostmanager.ip_resolver = proc do |vm, resolving_vm|
    if hostname = (vm.ssh_info && vm.ssh_info[:host])
      `vagrant ssh -c "hostname -I"`.split()[1]
    end
  end

  config.vm.provision 'shell', path: './vagrant/provision/once-as-root.sh'
  config.vm.provision 'shell', path: './vagrant/provision/once-as-vagrant.sh', privileged: false
  config.vm.provision 'shell', path: './vagrant/provision/always-as-root.sh', run: 'always'
end