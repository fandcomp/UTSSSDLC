pipeline {
    agent any

    environment {
        SONAR_TOKEN = credentials('sonar-token') // Atur lewat Jenkins Credentials
    }

    stages {
        stage('Checkout') {
            steps {
                git 'https://github.com/fandcomp/UTSSSDLC.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install' // Jika menggunakan Composer
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('MySonarServer') {
                    sh 'sonar-scanner -Dsonar.login=$SONAR_TOKEN'
                }
            }
        }

        stage('Quality Gate') {
            steps {
                script {
                    def qg = waitForQualityGate()
                    if (qg.status != 'OK') {
                        error "❌ Gagal Quality Gate dari SonarQube."
                    }
                }
            }
        }
    }
}
