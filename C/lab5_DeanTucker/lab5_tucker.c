#include "Lab5.h"

int main()
{
	AVL_TREE* arrList;
	int* arr;
	
	arrList = AVL_Create(compareInt);
	arr = createArray(100, arrList);
	createList(arr, arrList);
	printList(arrList);
	system("pause");
	return 0;
}

