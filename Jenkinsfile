pipeline {
    agent any
    environment {
        SONAR_TOKEN = credentials('sonarqube-token')
    }
    stages {
        stage('Checkout') {
            steps { git 'https://github.com/<user>/<repo>.git' }
        }
        stage('Install Dependencies') {
            steps { bat 'composer install' }
        }
        stage('Run PHPUnit') {
            steps { bat 'vendor\\bin\\phpunit --configuration phpunit.xml' }
        }
        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    bat 'E:\\Prog\\sonar-scanner\\bin\\sonar-scanner.bat'
                }
            }
        }
    }
    post {
        failure { echo 'Pipeline gagal, cek log.' }
    }
}
