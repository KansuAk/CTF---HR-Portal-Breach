# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "ubuntu/focal64"
  config.vm.box_version = "20240821.0.1"

  # Hostname (sichtbar im Prompt und Logs)
  config.vm.hostname = "hr-portal"

  # Privates Netzwerk (isoliert)
  config.vm.network "private_network", ip: "192.168.56.110"

  # Port Forwarding (optional für Browser-Zugriff)
  config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # VirtualBox Konfiguration
  config.vm.provider "virtualbox" do |vb|
    vb.name = "HR-Portal-CTF"

    # Ressourcen
    vb.memory = "2048"
    vb.cpus = 2

    # Don't show VirtualBox GUI window (headless)
    vb.gui = false

    # Linked clone (faster, uses less disk space)
    vb.linked_clone = true
  end

  # Provisioning: Use ansible_local (runs Ansible INSIDE the VM)
  # This avoids Python/conda conflicts on the host machine
  config.vm.provision "ansible_local" do |ansible|
    # Path to the playbook (relative to /vagrant inside the VM)
    ansible.playbook = "ansible/playbook.yml"

    # Verbose output (useful for debugging)
    ansible.verbose = "v"

    # Install Ansible automatically inside the VM
    ansible.install = true

    # Extra variables passed to Ansible
    ansible.extra_vars = {

      # SSH / User (Post-Exploitation Schritt)
      hr_user: "hruser",
      hr_password: "Summer2026!",

      # Web-App Credentials (werden via LFI gefunden)
      app_db_user: "hrapp",
      app_db_password: "SuperSecure123!",

      # Flags
      user_flag: "FLAG{hr_p0rt4l_us3r}",
      root_flag: "FLAG{r00t_4cc3ss_gr4nt3d}",

      # PrivEsc Steuerung
      enable_suid_find: true

    }
  end

  # Post-Provisioning Hinweis
  config.vm.post_up_message = <<-MSG

HR Portal CTF machine is ready!

Access:
  Web: http://192.168.56.110/  oder http://localhost:8080/
  
SSH (nach Exploit):
  ssh hruser@192.168.56.110

Workflow:
  1. Recon (nmap)
  2. LFI finden (?file=)
  3. Log Poisoning → RCE
  4. Credentials extrahieren
  5. SSH Login
  6. Privilege Escalation

Vagrant:
  To connect: vagrant ssh
  To halt: vagrant halt
  To rebuild: vagrant destroy && vagrant up

MSG

end
