#include <iostream>
#include <string>
#define CSIZE 4
using namespace std;

struct name {
	string first;
	string last;
}NAME;

struct student {
	name name;
	int grade[3];
	float avg;
};

void assignGrades(struct student records[]) {
	
	for (size_t i = 0; i <= 3; i++) {
		for (size_t j = 0; j <= 2; j++) {
			cout << "Please enter score " << j + 1 << " for " << records[i].name.first << " " << records[i].name.last << ": ";
			cin >> records[i].grade[j];
		}
		records[i].avg = (records[i].grade[0] + records[i].grade[1] + records[i].grade[2]) / 3;
		
	}
}

void printStruct(struct student records[]) {
	for (size_t i = 0; i <= 3; i++) {
		cout << "Records for student " << records[i].name.first << " " << records[i].name.last << endl;
		cout << "Grades: " << records[i].grade[0] << " " << records[i].grade[1] << " " << records[i].grade[2] << endl;
		cout << "Grade average: " << records[i].avg << endl;
	}

}

void printClassAvg(struct student records[]) {
	float classAvg;
	classAvg = (records[0].avg + records[1].avg + records[2].avg +records[3].avg)/4;
	cout << "The class average is: " << classAvg << endl;
}
int main()
{
	student records[CSIZE];
	records[0].name.first = "Ted";
	records[0].name.last = "Cruz";
	records[1].name.first = "Hillary";
	records[1].name.last = "Clinton"; 
	records[2].name.first = "Donald";
	records[2].name.last = "Trump"; 
	records[3].name.first = "Bernie";
	records[3].name.last = "Sanders";
  
	assignGrades(records);
	printStruct(records);
	printClassAvg(records);
	system("pause");
	return 0;
}

